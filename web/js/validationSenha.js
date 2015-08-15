   function Conferesenha(pw)
    {debugger;
        
         if($("#senhaatual").val() !== pw){
            $("#senhaatual").parent().parent().addClass("warning");
             $("#senhaatual").next().fadeIn();
              return false;
        } 
        else
            {
                 $("#senhaatual").parent().parent().removeClass("warning");
             $("#senhaatual").next().fadeOut();
            return true;
            }
    }
    function Conferenovasenha()
    {
        debugger;
        if($("#passwordNova").val() !== $("#repeti").val())
            {
              
                 debugger;
             $("#passwordNova").parent().parent().addClass("warning");
             $("#passwordNova").next().fadeIn();
             
             $("#repeti").parent().parent().addClass("warning");
             $("#repeti").next().fadeIn();
              return false;
                
            }
            else
                {
                      if($("#passwordNova").val() ==="" || $("#repeti").val() === ""){
                        
                          $("#passwordNova").parent().parent().addClass("warning");
             $("#passwordNova").next().html("Valor não pode ser em branco").fadeIn();
             $("#repeti").parent().parent().addClass("warning");
             $("#repeti").next().html("Valor não pode ser em branco").fadeIn();
              return false;
            }
                return true;
                }
    }