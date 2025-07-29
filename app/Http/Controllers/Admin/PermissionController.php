<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage permissions');
    }

    /**
     * Display a listing of permissions
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');

        $permissions = Permission::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(15)
            ->withQueryString();

        // Get role assignments for each permission
        $permissions->getCollection()->transform(function ($permission) {
            $permission->roles_count = $permission->roles()->count();
            $permission->roles_list = $permission->roles()->pluck('name')->toArray();
            return $permission;
        });

        return Inertia::render('Admin/Permissions/Index', [
            'permissions' => $permissions,
            'filters' => [
                'search' => $search,
                'sort_by' => $sortBy,
                'sort_order' => $sortOrder,
            ],
            'stats' => [
                'total_permissions' => Permission::count(),
                'total_roles' => Role::count(),
            ]
        ]);
    }

    /**
     * Show the form for creating a new permission
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        
        return Inertia::render('Admin/Permissions/Create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created permission
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'guard_name' => 'sometimes|string|max:255',
            'roles' => 'sometimes|array',
            'roles.*' => 'exists:roles,id'
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name ?? 'web'
        ]);

        // Assign to roles if specified
        if ($request->roles) {
            $roles = Role::whereIn('id', $request->roles)->get();
            foreach ($roles as $role) {
                $role->givePermissionTo($permission);
            }
        }

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    /**
     * Display the specified permission
     */
    public function show(Permission $permission)
    {
        $permission->load(['roles']);
        
        return Inertia::render('Admin/Permissions/Show', [
            'permission' => $permission,
            'roles' => $permission->roles,
            'available_roles' => Role::whereNotIn('id', $permission->roles->pluck('id'))->get()
        ]);
    }

    /**
     * Show the form for editing the specified permission
     */
    public function edit(Permission $permission)
    {
        $permission->load(['roles']);
        $allRoles = Role::orderBy('name')->get();
        
        return Inertia::render('Admin/Permissions/Edit', [
            'permission' => $permission,
            'roles' => $allRoles,
            'assigned_roles' => $permission->roles->pluck('id')->toArray()
        ]);
    }

    /**
     * Update the specified permission
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions')->ignore($permission->id)],
            'guard_name' => 'sometimes|string|max:255',
            'roles' => 'sometimes|array',
            'roles.*' => 'exists:roles,id'
        ]);

        $permission->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name ?? 'web'
        ]);

        // Sync roles
        if ($request->has('roles')) {
            // Remove all current role assignments
            $currentRoles = $permission->roles;
            foreach ($currentRoles as $role) {
                $role->revokePermissionTo($permission);
            }
            
            // Assign new roles
            if ($request->roles) {
                $roles = Role::whereIn('id', $request->roles)->get();
                foreach ($roles as $role) {
                    $role->givePermissionTo($permission);
                }
            }
        }

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified permission
     */
    public function destroy(Permission $permission)
    {
        // Check if permission is assigned to any roles
        if ($permission->roles()->count() > 0) {
            return back()->with('error', 'Cannot delete permission that is assigned to roles. Remove role assignments first.');
        }

        $permission->delete();

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }

    /**
     * Assign permission to role
     */
    public function assignRole(Request $request, Permission $permission)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $role = Role::findOrFail($request->role_id);
        
        if (!$role->hasPermissionTo($permission)) {
            $role->givePermissionTo($permission);
            return back()->with('success', "Permission assigned to {$role->name} role.");
        }

        return back()->with('info', "Permission already assigned to {$role->name} role.");
    }

    /**
     * Remove permission from role
     */
    public function revokeRole(Request $request, Permission $permission)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $role = Role::findOrFail($request->role_id);
        
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            return back()->with('success', "Permission revoked from {$role->name} role.");
        }

        return back()->with('info', "Permission not assigned to {$role->name} role.");
    }
}