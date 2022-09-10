# Run this script as Adminsitrator in Powershell
$vm = Get-VM -Name DockerDesktopVM
$feature = "Time Synchronization"

Disable-VMIntegrationService -vm $vm -Name $feature
Enable-VMIntegrationService -vm $vm -Name $feature