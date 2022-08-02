function validarForm() { 
    var optionSelect = document.getElementById("tipo").value;

    if(optionSelect =="Fardo" ){ 
        document.getElementById("quantidade_fardo").disabled = false;
        document.getElementById("pc_fardo").innerText = "Preço custo do fardo";
        document.getElementById("pv_venda").innerText = "Preço venda do fardo";
    }else{
        document.getElementById("quantidade_fardo").disabled = true;
        document.getElementById("quantidade_fardo").value = null;
        document.getElementById("pc_fardo").innerText = "Preço de custo";
        document.getElementById("pv_venda").innerText = "Preço de venda";

    } 
    
}


    