<script>
        function onSuccess(data, status)
        {
            data = $.trim(data);
            $("#wineresults").html(data); // Need to abstract this
        }
 
        function onError(data, status)
        {
            // handle an error
        }        
 
        $(document).ready(function() {
            $("#search").click(function(){
 
                var formData = $("#searchform").serialize();
 
                $.ajax({
                    type: "POST",
                    url: "/search/wine/",
                    cache: false,
                    data: formData,
                    success: onSuccess,
                    error: onError
                });
 
                return false;
            });
        });
    </script>