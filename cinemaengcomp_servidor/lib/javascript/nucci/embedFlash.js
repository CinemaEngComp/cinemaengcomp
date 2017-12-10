<%
	require "../../../config/custom/n_config.asp";		
	require "../../../config/nucci/n_nucci_definitions.asp";		
%>
document.writeln('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"');
document.writeln('      width= "289" height= "148"');
document.writeln('      codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0">');
document.writeln('<param name="archive" value="<%=$site_base;%>php/lib/applet/raduploadplus/radupload-plus-2.20/dndplus.jar">');
document.writeln('<param name="code" value="com.radinks.dnd.DNDAppletPlus">');
document.writeln('<param name="name" value="Rad Upload Plus">');