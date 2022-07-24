
  
const recuperarLocalizacao = () => { //recuperar toda a localizacao digitada no iframe

    // recupera os dados atraves do iframe
    const myIframe = document.getElementById('iframe');

    const iframeWindow = myIframe.contentWindow; 

    const iframeDocument = myIframe.contentDocument;

    //recupera dos dados que sao digitadoes no campo do iframe

    if (iframeDocument.getElementById('pac-input') != null){
        var pacInput = iframeDocument.getElementById('pac-input'); 
    }
    //recebe os dados de latitude direto do javascript iframe
    var lat = iframeDocument.getElementById('latitude');
    //recebe os dados de longitude direto do javascript
    var long = iframeDocument.getElementById('longitude');

    if(pacInput.value != null){ 

        // campo input recebendo valor digitado pelo iframe
        document.querySelector("[name='endereco']").value = pacInput.value;

        if($("#enderecoAtual") && pacInput.value !== ""){
            $("#enderecoAtual").text(pacInput.value);
        }
    }

    if (lat.value != null){
        document.querySelector("[name='latitude']").value = lat.value;
    }

    if (lat.value != null){
        document.querySelector("[name='longitude']").value = long.value;
    }
    
    var endereco = document.querySelector("[name='endereco']");

    var latitude = document.querySelector("[name='latitude']");

    var longitude = document.querySelector("[name='longitude']");

    console.log(endereco.value,latitude.value,longitude.value);

}

