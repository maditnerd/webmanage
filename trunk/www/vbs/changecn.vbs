const HKLM   = &H80000002

		errorlevel = 0
		
	    Set oArgs = WScript.Arguments
	    Set WshShell = CreateObject("WScript.Shell")
	    Set objFSO = CreateObject("Scripting.FileSystemObject")
	    Set oNetwork = CreateObject("WScript.Network")
	    strCurrentComputerName = oNetwork.ComputerName
	    strNewName = oArgs(0)
	 
	    strKeyPath   = "System\CurrentControlSet\Control\ComputerName\ComputerName"
	    set objReg = GetObject("winmgmts:\\" & strCurrentComputerName & "\root\default:StdRegProv")
	    intRC = objReg.SetStringValue(HKLM, strKeyPath, "ComputerName", strNewName)
	 
	    if intRC <> 0 Then
	        errorlevel = 1
	    end if
	 
	    strKeyPath   = "System\CurrentControlSet\Services\Tcpip\Parameters"
	    intRC = objReg.SetStringValue(HKLM, strKeyPath, "NV Hostname", strNewName)
	    if intRC <> 0 Then
	        errorlevel = 1       
	    end if
		
Wscript.echo errorlevel