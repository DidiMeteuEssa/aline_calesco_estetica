function validarCampos(opr) {
    const cpf = document.getElementById("cpf").value.replace(/\D/g, '');
    const cep = document.getElementById("cep").value.replace(/\D/g, '');
    const celular = document.getElementById("celular").value.replace(/\D/g, '');
    const data_nasc = document.getElementById("data_nasc").value.replace(/\D/g, '');

    if (cpf.length !== 11) {
        alert("CPF inválido! Digite os 11 números.");
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


