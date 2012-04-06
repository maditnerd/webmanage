res1 = Msgbox("Rédémarrage de l'ordinateur requis",vbYesNo + VbCritical)
if res1 = 6 then
set shl = createobject("wscript.shell" )
Wscript.echo "OK"
Else
res2 = InputBox("Raison du refus","Informations","Je suis occupé")
Do While res2 = ""
res2 = InputBox("Raison du refus","Informations","Je suis occupé")
Loop
Wscript.echo res2

End If
