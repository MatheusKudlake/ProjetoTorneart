function mascaraPreco(idInput){
    document.getElementById(idInput).addEventListener('input', function(){
        const regexDecimal = /^\d+\.?(\d{1,2})?/;
        const regexDigito = /^\d+$/;
        if(!regexDigito.test(this.value[0])){
            this.value = "";
            return;
        }

        const textoReplace = this.value.replace(',','.');
        this.value = textoReplace;

        const result = regexDecimal.exec(textoReplace);
        if(result != null && result[0].length < textoReplace.length){
            this.value = result[0];
        }
    });
}

function mascaraNumeros(idInput){
    document.getElementById(idInput).addEventListener('input', function(){
        const regex = /^\d+/;
        const result = regex.exec(this.value);
        if(result === null){
            this.value = "";
        }else if(result[0].length < this.value.length){
            this.value = result[0];
        }
    });
}