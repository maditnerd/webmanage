Set wshNetwork = WScript.CreateObject( "WScript.Network" )
strComputerName = wshNetwork.ComputerName
WScript.Echo strComputerName