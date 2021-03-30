
function vibro1(){
    
    //Ajax La magia de todo
    var timer = setInterval(MyTimer,1000);
    function MyTimer(){
        $.ajax({
            method:"GET",
            url: $('.ruta').attr('href'),
        }).done(function(response){                                                                                                                                                                                                                                                                                                                                           


        }).fail(function(jqXHR,textStatus){
            clearInterval(timer);
            //console.log(jqXHR);
        });
    }
}