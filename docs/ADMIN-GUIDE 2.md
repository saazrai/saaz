# Admin Panel Guide - SecureStart™ V1

## Overview

The SecureStart™ V1 admin panel provides comprehensive tools for managing users, monitoring assessments, and maintaining the diagnostic platform. This guide covers the essential features available in V1.

## Access Requirements

### Roles and Permissions

The system includes four primary roles:

1. **Super Admin** - Full system access
2. **Admin** - General administrative access
3. **Moderator** - Limited administrative access
4. **User** - Standard user role (no admin access)

### Default Admin Accounts

For development/testing:
- **Super Admin**: admin@securestart.com / password
- **Admin**: admin@example.com / password  
- **Moderator**: moderator@example.com / password

**Important**: Change these passwords immediately in production!

## Admin Panel Features (V1)

### 1. Dashboard
- **URL**: `/admin/dashboard`
- **Features**:
  - User statistics (total, active, new)
  - Assessment metrics (total, completed, average scores)
  - Recent activity monitoring
  - 7-day completion rate trends
  - User role distribution

### 2. User Management
- **URL**: `/admin/users`
- **Features**:
  - View all registered users
  - Search and filter by name, email, role, or status
  - Create new users with role assignment
  - Edit user details
  - Manage user roles
  - Verify unverified users
  - Delete users
  - Pagination for large user lists

### 3. Audit Logs
- **URL**: `/admin/audits`
- **Features**:
  - Track all admin actions
  - View detailed audit information
  - Filter by user, action type, or date
  - Export audit logs

## Implementation Details

### Technology Stack
- **Backend**: Laravel 11 with Spatie Permission package
- **Frontend**: Vue 3 with Inertia.js
- **UI Components**: Custom components with Tailwind CSS
- **Real-time**: Laravel Echo (WebSocket integration ready)
- **Theme System**: Dark/light mode support

### Middleware Protection
All admin routes are protected by:
1. `auth` middleware - Ensures user is authenticated
2. `admin.access` middleware - Verifies admin permissions
3. Active user check - Ensures account is not disabled

### Database Structure

#### User Fields (Admin-specific)
```php
$table->boolean('is_active')->default(true);
$table->timestamp('last_login_at')->nullable();
$table->integer('login_count')->default(0);
```

#### Roles Table
- id
- name
- guard_name
- created_at
- updated_at

#### Permissions Table
- id
- name
- guard_name
- created_at
- updated_at

## Usage Instructions

### Accessing the Admin Panel

1. Navigate to `/login`
2. Enter admin credentials
3. After login, navigate to `/admin/dashboard`
4. Or click "Admin Panel" in the user dropdown menu

### Managing Users

1. Go to `/admin/users`
2. Use search and filters to find specific users
3. Click "Add User" to create new users
4. Click "Edit" to modify user details
5. Click "Roles" to manage user permissions
6. Click "Delete" to remove users (with confirmation)

### Monitoring Activity

1. Dashboard shows real-time statistics
2. Audit logs track all administrative actions
3. WebSocket integration provides live updates when enabled

## Security Considerations

1. **Password Policy**: Enforce strong passwords for admin accounts
2. **Two-Factor Authentication**: Recommended for admin users (implement in V2)
3. **Session Management**: Admin sessions should timeout after inactivity
4. **IP Whitelisting**: Consider restricting admin access by IP
5. **Regular Audits**: Review audit logs regularly
6. **Principle of Least Privilege**: Assign minimal required permissions

## Troubleshooting

### Common Issues

1. **Cannot access admin panel**
   - Verify user has admin role
   - Check if account is active (`is_active = true`)
   - Ensure permissions are properly seeded

2. **Missing permissions**
   - Run `php artisan db:seed --class=RolesAndPermissionsSeeder`
   - Clear cache: `php artisan cache:clear`

3. **Theme not applying**
   - Check localStorage for `adminDarkMode` key
   - Verify theme initialization in AdminLayout

4. **WebSocket not connecting**
   - Verify Echo server is running
   - Check `.env` for correct WebSocket configuration
   - Review browser console for connection errors

## Development Commands

```bash
# Seed admin users
php artisan db:seed --class=CreateAdminUserSeeder

# Reset roles and permissions
php artisan db:seed --class=RolesAndPermissionsSeeder

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Run migrations
php artisan migrate

# Build assets
npm run build
```

## Future Enhancements (V2)

The following features are planned for V2:
- Advanced analytics and reporting
- Question bank management
- Assessment configuration
- Learning management features
- E-commerce integration
- Advanced user tracking
- Bulk operations
- API access management
- Custom dashboard widgets
- Email notifications

## Support

For issues or questions:
1. Check the troubleshooting section
2. Review audit logs for error details
3. Consult the main documentation
4. Contact the development team

---

*Last updated: July 2025*