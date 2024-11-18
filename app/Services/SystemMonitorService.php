<?php

namespace App\Services;

class SystemMonitorService
{
    /**
     * Lấy toàn bộ thông tin hệ thống
     * @return array
     */
    public function getAllSystemInfo()
    {
        return [
            'os_info' => $this->getOsInfo(),
            'cpu_info' => $this->getCpuInfo(),
            'cpu_usage' => $this->getCpuUsage(),
            'memory_usage' => $this->getMemoryUsage(),
            'disk_usage' => $this->getDiskUsage(),
            'network_info' => $this->getNetworkInfo(),
            'processes' => $this->getProcessCount(),
            'services' => $this->getServiceStatus(),
            'php_info' => $this->getPhpInfo(),
            'server_load' => $this->getServerLoad(),
            'uptime' => $this->getUptime(),
            'users' => $this->getActiveUsers(),
            'last_logins' => $this->getLastLogins(),
            'installed_software' => $this->getInstalledSoftware(),
            'security_info' => $this->getSecurityInfo(),
        ];
    }


    /**
     * Lấy thông tin về hệ điều hành
     * @return array
     */
    public function getOsInfo()
    {
        if (PHP_OS === 'Linux') {
            $os_release = parse_ini_file('/etc/os-release');
            return [
                'os_name' => $os_release['PRETTY_NAME'] ?? PHP_OS,
                'kernel_version' => trim(shell_exec('uname -r')),
                'architecture' => php_uname('m'),
                'hostname' => gethostname(),
                'timezone' => date_default_timezone_get(),
                'date_time' => date('Y-m-d H:i:s')
            ];
        } elseif (PHP_OS_FAMILY === 'Windows') {
            return [
                'os_name' => 'Windows',
                'architecture' => php_uname('m'),
                'hostname' => gethostname(),
                'timezone' => date_default_timezone_get(),
                'date_time' => date('Y-m-d H:i:s')
            ];
        }
        return ['os_name' => PHP_OS];
    }

    /**
     * Lấy thông tin chi tiết về CPU
     * @return array
     */
    public function getCpuInfo()
    {
        if (PHP_OS === 'Linux') {
            $cpu_info = shell_exec('lscpu');
            $cpu_info = explode("\n", $cpu_info);
            $info = [];
            
            foreach ($cpu_info as $line) {
                if (strpos($line, ':') !== false) {
                    list($key, $value) = explode(':', $line, 2);
                    $info[trim($key)] = trim($value);
                }
            }
            
            return [
                'model' => $info['Model name'] ?? 'Unknown',
                'cores' => $info['CPU(s)'] ?? 'Unknown',
                'architecture' => $info['Architecture'] ?? 'Unknown',
                'max_speed' => $info['CPU max MHz'] ?? 'Unknown',
                'cache_size' => $info['Cache size'] ?? 'Unknown'
            ];
        } elseif (PHP_OS_FAMILY === 'Windows') {
            $cpu_info = shell_exec("wmic cpu get Name,NumberOfCores,MaxClockSpeed,CacheSize");
            $cpu_data = explode("\n", trim($cpu_info));
            return [
                'model' => $cpu_data[1] ?? 'Unknown',
                'cores' => $cpu_data[2] ?? 'Unknown',
                'max_speed' => $cpu_data[3] ?? 'Unknown MHz',
                'cache_size' => $cpu_data[4] ?? 'Unknown KB'
            ];
        }
        return ['error' => 'CPU info not available'];
    }

    /**
     * Lấy thông tin về network
     * @return array
     */
    public function getNetworkInfo()
    {
        if (PHP_OS === 'Linux') {
            // Network interfaces
            $interfaces = shell_exec("ip -j addr");
            $interfaces = json_decode($interfaces, true);

            // Network statistics
            $netstat = shell_exec("netstat -s");
            
            // Current connections
            $connections = shell_exec("netstat -an | grep ESTABLISHED | wc -l");
            
            return [
                'interfaces' => $interfaces,
                'active_connections' => (int)$connections,
                'ip_address' => gethostbyname(gethostname()),
                'hostname' => gethostname(),
                'statistics' => $netstat
            ];
        } 
        return ['error' => 'Network info not available'];
    }

    /**
     * Lấy thông tin về các service đang chạy
     * @return array
     */
    public function getServiceStatus()
    {
        if (PHP_OS === 'Linux') {
            $services = [
                'nginx' => $this->checkService('nginx'),
                'apache2' => $this->checkService('apache2'),
                'mysql' => $this->checkService('mysql'),
                'redis' => $this->checkService('redis'),
                'postgresql' => $this->checkService('postgresql'),
                'mongodb' => $this->checkService('mongod'),
                'elasticsearch' => $this->checkService('elasticsearch'),
                'supervisor' => $this->checkService('supervisor'),
            ];
            
            return array_filter($services);
        }
        return ['error' => 'Service status not available'];
    }

    /**
     * Kiểm tra trạng thái một service
     * @param string $service
     * @return array|null
     */
    private function checkService($service)
    {
        $status = shell_exec("systemctl is-active $service 2>&1");
        if ($status !== null) {
            return [
                'name' => $service,
                'status' => trim($status),
                'pid' => trim(shell_exec("pidof $service")),
                'uptime' => trim(shell_exec("systemctl show $service --property=ActiveEnterTimestamp"))
            ];
        }
        return null;
    }

    /**
     * Lấy thông tin về PHP
     * @return array
     */
    public function getPhpInfo()
    {
        return [
            'version' => PHP_VERSION,
            'extensions' => get_loaded_extensions(),
            'memory_limit' => ini_get('memory_limit'),
            'max_execution_time' => ini_get('max_execution_time'),
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'post_max_size' => ini_get('post_max_size'),
            'display_errors' => ini_get('display_errors'),
            'error_reporting' => ini_get('error_reporting'),
            'date.timezone' => ini_get('date.timezone')
        ];
    }

    /**
     * Lấy thông tin về server load
     * @return array
     */
    public function getServerLoad()
    {
        if (PHP_OS === 'Linux') {
            $load = sys_getloadavg();
            return [
                'current' => $load[0],
                'last_5min' => $load[1],
                'last_15min' => $load[2]
            ];
        }
        return ['error' => 'Server load not available'];
    }

    /**
     * Lấy thời gian uptime của server
     * @return array
     */
    public function getUptime()
    {
        if (PHP_OS === 'Linux') {
            $uptime = shell_exec('uptime -p');
            $started = shell_exec('uptime -s');
            return [
                'uptime' => trim($uptime),
                'started' => trim($started)
            ];
        }
        return ['error' => 'Uptime not available'];
    }

    /**
     * Lấy danh sách user đang active
     * @return array
     */
    public function getActiveUsers()
    {
        if (PHP_OS === 'Linux') {
            $users = shell_exec('who');
            $users = explode("\n", trim($users));
            $active_users = [];
            
            foreach ($users as $user) {
                if (!empty($user)) {
                    $parts = preg_split('/\s+/', $user);
                    $active_users[] = [
                        'username' => $parts[0],
                        'terminal' => $parts[1],
                        'login_time' => $parts[2] . ' ' . $parts[3],
                        'ip_address' => isset($parts[4]) ? trim($parts[4], '()') : null
                    ];
                }
            }
            
            return $active_users;
        }
        return ['error' => 'Active users info not available'];
    }

    /**
     * Lấy lịch sử login gần đây
     * @return array
     */
    public function getLastLogins()
    {
        if (PHP_OS === 'Linux') {
            $last = shell_exec('last -n 10');
            return [
                'last_logins' => explode("\n", trim($last))
            ];
        }
        return ['error' => 'Login history not available'];
    }

    /**
     * Lấy danh sách phần mềm đã cài đặt
     * @return array
     */
    public function getInstalledSoftware()
    {
        if (PHP_OS === 'Linux') {
            $dpkg = shell_exec('dpkg -l | grep "^ii" | head -n 10');
            return [
                'installed_packages' => explode("\n", trim($dpkg))
            ];
        }
        return ['error' => 'Software info not available'];
    }

    /**
     * Lấy thông tin bảo mật
     * @return array
     */
    public function getSecurityInfo()
    {
        if (PHP_OS === 'Linux') {
            return [
                'firewall_status' => shell_exec('ufw status'),
                'listening_ports' => shell_exec('netstat -tuln'),
                'last_security_updates' => shell_exec('grep "security" /var/log/dpkg.log | tail -n 5'),
                'failed_login_attempts' => shell_exec('grep "Failed password" /var/log/auth.log | tail -n 5')
            ];
        }
        return ['error' => 'Security info not available'];
    }

        /**
     * Lấy thông tin về CPU usage
     * @return array
     */
    public function getCpuUsage()
    {
        if (PHP_OS === 'Linux') {
            $load = sys_getloadavg();
            return [
                'load_1min' => $load[0],
                'load_5min' => $load[1],
                'load_15min' => $load[2],
                'cpu_usage_percentage' => $this->getLinuxCpuUsage()
            ];
        }
        
        return ['error' => 'Chỉ hỗ trợ hệ điều hành Linux'];
    }

    /**
     * Lấy phần trăm CPU usage trên Linux
     * @return float
     */
    private function getLinuxCpuUsage()
    {
        $cmd = "top -bn1 | grep 'Cpu(s)' | awk '{print $2 + $4}'";
        return (float) shell_exec($cmd);
    }

    /**
     * Lấy thông tin về memory usage
     * @return array
     */
    public function getMemoryUsage()
    {
        if (PHP_OS === 'Linux') {
            $free = shell_exec('free');
            $free = (string)trim($free);
            $free_arr = explode("\n", $free);
            $mem = explode(" ", $free_arr[1]);
            $mem = array_filter($mem);
            $mem = array_merge($mem);

            $totalMemory = isset($mem[1]) ? $mem[1] * 1024 : 0;
            $usedMemory = isset($mem[2]) ? $mem[2] * 1024 : 0;
            $freeMemory = isset($mem[3]) ? $mem[3] * 1024 : 0;

            $percentageUsed = $totalMemory > 0 ? round(($usedMemory / $totalMemory) * 100, 2) : 0;

            return [
                'total' => $this->formatBytes($totalMemory),
                'used' => $this->formatBytes($usedMemory),
                'free' => $this->formatBytes($freeMemory),
                'percentage_used' => $percentageUsed
            ];
        }

        return [
            'total' => $this->formatBytes(memory_get_peak_usage(true)),
            'used' => $this->formatBytes(memory_get_usage(true)),
            'free' => 'N/A'
        ];
    }


    /**
     * Lấy thông tin về disk usage
     * @return array
     */
    public function getDiskUsage()
    {
        $disks = [];
        if (PHP_OS === 'Linux') {
            $cmd = "df -h | grep -v tmpfs | grep -v devtmpfs";
            $output = shell_exec($cmd);
            $lines = explode("\n", trim($output));
            
            foreach ($lines as $line) {
                $parts = preg_split('/\s+/', trim($line));
                if (isset($parts[5])) {
                    $disks[] = [
                        'filesystem' => $parts[0],
                        'size' => $parts[1],
                        'used' => $parts[2],
                        'available' => $parts[3],
                        'percentage_used' => str_replace('%', '', $parts[4]),
                        'mounted_on' => $parts[5]
                    ];
                }
            }
        } elseif (PHP_OS_FAMILY === 'Windows') {
            $output = shell_exec("wmic logicaldisk get Caption,Size,FreeSpace");
            $lines = explode("\n", trim($output));
    
            foreach ($lines as $index => $line) {
                if ($index > 0 && !empty($line)) {
                    $parts = preg_split('/\s+/', trim($line));
                    $disks[] = [
                        'filesystem' => $parts[0],
                        'size' => $this->formatBytes($parts[1]),
                        'used' => $this->formatBytes($parts[1] - $parts[2]),
                        'available' => $this->formatBytes($parts[2]),
                        'percentage_used' => round((1 - $parts[2] / $parts[1]) * 100, 2)
                    ];
                }
            }
        }
        
        return $disks;
    }

    /**
     * Lấy số lượng processes đang chạy
     * @return array
     */
    public function getProcessCount()
    {
        $totalProcesses = 0;
        $activeProcesses = 0;
    
        if (PHP_OS === 'Linux') {
            // Lấy tổng số tiến trình trên Linux
            $cmdTotal = escapeshellcmd("ps aux | wc -l");
            $totalProcesses = (int) shell_exec($cmdTotal) - 1; // Trừ đi 1 vì dòng tiêu đề
    
            // Lấy số lượng tiến trình đang sử dụng (trừ bỏ các tiến trình nhàn rỗi, ví dụ: root hoặc daemon)
            $cmdActive = escapeshellcmd("ps aux --no-headers | grep -v 'root' | grep -v 'daemon' | wc -l");
            $activeProcesses = (int) shell_exec($cmdActive);
    
        } elseif (PHP_OS === 'WINNT') {
            // Lấy tổng số tiến trình trên Windows
            $cmdTotal = escapeshellcmd("tasklist /FO CSV");
            $output = shell_exec($cmdTotal);
            
            if ($output) {
                $processes = explode("\n", trim($output));
                $totalProcesses = count($processes) - 1; // Trừ đi dòng tiêu đề
    
                // Đếm số tiến trình đang hoạt động (lọc ra các tiến trình hệ thống nhàn rỗi)
                foreach ($processes as $index => $process) {
                    if ($index == 0) continue; // Bỏ qua tiêu đề
                    if (!stripos($process, 'System Idle Process') && !stripos($process, 'System')) {
                        $activeProcesses++;
                    }
                }
            } else {
                return ['error' => 'Không thể lấy số lượng tiến trình trên Windows'];
            }
        } else {
            return ['error' => 'Hệ điều hành không được hỗ trợ'];
        }
    
        // Tính phần trăm tiến trình đang sử dụng
        $usagePercentage = $totalProcesses > 0 ? round(($activeProcesses / $totalProcesses) * 100, 2) : 0;
    
        return [
            'total_processes' => $totalProcesses,
            'active_processes' => $activeProcesses,
            'usage_percentage' => $usagePercentage . '%'
        ];
    }

    /**
     * Format bytes sang định dạng dễ đọc
     * @param int $bytes
     * @return string
     */
    private function formatBytes($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        $bytes /= pow(1024, $pow);
        
        return round($bytes, 2) . ' ' . $units[$pow];
    }
}