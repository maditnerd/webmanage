    strComputer = "."
     
    Set objWMIService = GetObject("winmgmts:" & "!\\" & strComputer & "\root\cimv2")
    Set colAdapters = objWMIService.ExecQuery("Select * from Win32_NetworkAdapter Where NetConnectionStatus = 2")
    For Each objAdapter in colAdapters
    
    msg = msg & ";" & objAdapter.NetConnectionID(i) & vbCrLf
 
    Next
          
    Wscript.Echo msg