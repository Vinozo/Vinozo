<script>
        function onSuccess(data, status)
        {
            data = $.trim(data);
            $("#checkindetails").html(data); // Need to abstract this
        }
 
        function onError(data, status)
        {
            // handle an error
            $("#checkindetails").html('there was an error');
        }        
 
        $(document).ready(function() {
            $('#checkinview').live( 'pageinit',function(event, ui){
 				//alert('checkinview loaded')
                //var formData = $("#searchform").serialize();
 				$.mobile.showPageLoadingMsg();
                $.ajax({
                    type: "POST",
                    url: "/wine/checkin/" + $(this).jqmData('wineId'),
                    cache: false,
                    //data: formData,
                    success: onSuccess,
                    error: onError
                });
 
 			//$('#content').html('<h2>Checking In: '+$(this).jqmData('name')+'</h2>')
                return false;
            });
        });
    </script>