$(document).ready(function(e){

    $('#find_btn').click(function(e){
        var data = $(this).closest("form").serializeArray();
         $.ajax({
            url : 'request.php',
            type: "GET",
            data : data,
            success:function(data, textStatus, jqXHR) 
            {
                if(data){
                    if(data.status){
                        var ul = $('#results');
                        ul.html(''); //reset prev.results
                        for(var i=0; i<data.data.length; i++){
                            ul.append('<li>' + data.data[i].group + 
                                      ' > ' + data.data[i].code + 
                                      ' > ' + data.data[i].price + 
                                      ' > ' + data.data[i].name + '</li>');    
                        }
                    }else{
                        alert(data.message);
                    }
                }else{
                    alert('Unknown error.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) { alert(textStatus); }
        });  
    });
    
    $('#find_btn').click();
    
});
