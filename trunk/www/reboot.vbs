Set OpSysSet = GetObject("winmgmts:{impersonationLevel=impersonate,(Shutdown)}//" & strComputer).ExecQuery("select * from Win32_OperatingSystem where Primary=true")
for each OpSys in OpSysSet
OpSys.Reboot()
Next  