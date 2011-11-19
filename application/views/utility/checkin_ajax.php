<script>
        function onSuccess(data, status)
        {
            data = $.trim(data);
            $("#winedetails").html(data); // Need to abstract this
        }
 
        function onError(data, status)
        {
            // handle an error
        }        
 
        $(document).ready(function() {
            $("#checkin").click(function(){
 
                //var formData = $("#searchform").serialize();
 
                $.ajax({
                    type: "POST",
                    url: "/wine/checkin"+wineId,
                    cache: false,
                    //data: formData,
                    success: onSuccess,
                    error: onError
                });
 
                return false;
            });
        });
    </script>