function validarCampos(opr) {
    const cpf = document.getElementById("cpf").value
    const cep = document.getElementById("cep").value.replace(/\D/g, '');
    const celular = document.getElementById("celular").value.replace(/\D/g, '');
    const data_nasc = document.getElementById("data_nasc").value.replace(/\D/g, '');
    const idade = parseInt(document.getElementById("idade").value.replace(/\D/g, ''));

    let ano_nasc = parseInt(data_nasc.substring(4, 8));
    
    const dia = parseInt(data_nasc.substring(0, 2));
    const mes = parseInt(data_nasc.substring(2, 4));

    const hoje = new Date();
    const ano = hoje.getFullYear();

    if(dia <= 0 || dia > 31) {
        alert("O campo 'dia' da data de nasc. é inválido.");
        document.getElementById("idade").focus();
        return false;
    }

    if(mes <= 0 || mes > 12) {
        alert("O campo 'mês' da data de nasc. é inválido.");
        document.getElementById("idade").focus();
        return false;
    }

    if(ano_nasc < 1900 || ano_nasc > ano) {
        alert("O campo 'ano' da data de nasc. é inválido.");
        document.getElementById("idade").focus();
        return false;
    }

    if(ano - ano_nasc !== idade && (ano - ano_nasc) - 1 !== idade)
    {
        alert("A idade não condiz com o a data de nascimento.");
        document.getElementById("idade").focus();
        return false;
    }

    if (!validarCPF(cpf)) {
        alert("CPF inválido! Verifique os numeros e tente novamente.");
        document.getElementById("cpf").focus();
        return false;
    }

    if (cep.length !== 8) {
        alert("CEP inválido! Deve conter 8 números.");
        document.getElementById("cep").focus();
        return false;
    }

    if (celular.length !== 11) {
        alert("Celular inválido! Deve conter 11 números (DDD + número).");
        document.getElementById("celular").focus();
        return false;
    }

    if (data_nasc.length !== 8) {
        alert("Data de nascimento inválida! Preencha a data corretamente.");
        document.getElementById("data_nasc").focus();
        return false;
    }

    if (opr==1) {
        alert("Cadastro realizada com sucesso!");
    }

    if(opr == 2) {
        alert("Alteração realizada com sucesso!");
    }
    
    return true;
}


function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, ''); 

    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
        return false; 
    }

    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let resto = 11 - (soma % 11);
    let digito1 = (resto >= 10) ? 0 : resto;

    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    resto = 11 - (soma % 11);
    let digito2 = (resto >= 10) ? 0 : resto;

    return cpf.charAt(9) == digito1 && cpf.charAt(10) == digito2;
}



