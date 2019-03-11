<?php


?>
<script type="text/javascript">

/// here is our login form that we are using to post username and password information.
$("#frmLogin").submit(function(e){
      e.preventDefault();
      $.post('login.php?action=login', $("#frmLogin").serialize(), function(data){
    var data = jQuery.parseJSON(data);
    document.cookie="tokanVal="+ data['resp']['jwt']; /// you can set returned token in cookie or session and
                                                                    can send with each request to authenticate user
    window.location.reload(true);

      });

  });

// get your-token-value where you have set it in session , cookie or somewhere and send with each request that you want to authenticate .
$.post('login.php?action=authenticate&tokVal=your-token-value',function(resp)
		{
			//alert(resp);
			if (resp.success == true)
			{
				/// if token authenticated successfully
                                //// get your data
			}
			else
			{
                                /// if token authentication failed
			}
		},'json');
</script>
