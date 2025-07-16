<?php

namespace App\Traits;

use OwenIt\Auditing\Contracts\Auditable;

trait AuditableModel
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Default audit configuration for SecureStart™ models
     */
    protected $auditTimestamps = false;
    protected $auditStrict = true;
    protected $auditThreshold = 1000;

    /**
     * Attributes that should be excluded from auditing by default
     */
    protected $auditExclude = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Custom audit events for diagnostic models
     */
    protected $auditEvents = [
        'created',
        'updated',
        'deleted',
        'restored',
    ];

    /**
     * Transform audit data for privacy compliance
     */
    public function transformAudit(array $data): array
    {
        // Remove sensitive data for GDPR compliance
        if (isset($data['user_agent'])) {
            $data['user_agent'] = $this->anonymizeUserAgent($data['user_agent']);
        }

        if (isset($data['ip_address'])) {
            $data['ip_address'] = $this->anonymizeIpAddress($data['ip_address']);
        }

        return $data;
    }

    /**
     * Anonymize user agent for privacy
     */
    protected function anonymizeUserAgent(string $userAgent): string
    {
        // Keep basic browser info but remove detailed version numbers
        $patterns = [
            '/(\d+\.\d+\.\d+\.\d+)/' => 'x.x.x.x',
            '/(\d+\.\d+\.\d+)/' => 'x.x.x',
        ];

        return preg_replace(array_keys($patterns), array_values($patterns), $userAgent);
    }

    /**
     * Anonymize IP address for privacy (keep first 3 octets for IPv4)
     */
    protected function anonymizeIpAddress(string $ipAddress): string
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $parts = explode('.', $ipAddress);
            $parts[3] = 'xxx';
            return implode('.', $parts);
        }

        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $parts = explode(':', $ipAddress);
            // Keep first 4 parts for IPv6
            return implode(':', array_slice($parts, 0, 4)) . ':xxxx:xxxx:xxxx:xxxx';
        }

        return 'xxx.xxx.xxx.xxx';
    }
}