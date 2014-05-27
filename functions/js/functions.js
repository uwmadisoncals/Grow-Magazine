// JavaScript Document    <script type="text/javascript">
    function toggle(t){
		if (document.getElementById('sociable').style.display='none'){
			document.getElementById('sociable').style.display='block';
			t.style.backgroundPosition='0px -48px';
			
		} else if (document.getElementById('sociable').style.display='block'){
			document.getElementById('sociable').style.display='none';
			t.style.backgroundPosition='0px -32px';
	
		}
		return;
		}
