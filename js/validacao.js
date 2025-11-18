const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 

/** 
 * Valida Email
 * @param {HTMLElement} campo - campo email
 * @returns {boolean} - true = válido / false = inválido 
 */ 

function validarEmail(campo) {
    const email = campo.value;

    if (emailRegex.test(email)) { 
        // válido: 
        campo.style.border = '1px solid green'; // Borda verde (OK!) 
        campo.setCustomValidity('');           // Tira qualquer aviso de erro. 

        return true; 

    } else { 
        // inválido: 
        campo.style.border = '2px solid red';  // Borda vermelha (ERRO!) 

        const mensagemErro = 'Por favor, insira um endereço de e-mail válido.'; 
        campo.setCustomValidity(mensagemErro); 

        return false; 
    } 
} 

document.addEventListener('DOMContentLoaded', function() { 

    const campoEmail = document.getElementById('id_email'); 

    campoEmail.addEventListener('blur', function() { 
        validarEmail(campoEmail); 
    }); 

});

// Expressão regular para validar o formato com máscara (999.999.999-99)
const cpfMaskRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;

/**
 * Aplica máscara de CPF automaticamente enquanto digita.
 * @param {HTMLElement} campo - campo de entrada de CPF
 */
function aplicarMascaraCPF(campo) {
    let valor = campo.value.replace(/\D/g, ''); // remove tudo que não é número

    if (valor.length > 11) valor = valor.slice(0, 11); // limita a 11 dígitos

    // Aplica formatação dinâmica
    valor = valor
        .replace(/^(\d{3})(\d)/, '$1.$2')
        .replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3')
        .replace(/\.(\d{3})(\d{1,2})$/, '.$1-$2');

    campo.value = valor;
}

/**
 * valida CPF (com formato 999.999.999-99)
 * @param {HTMLElement} campo - campo de entrada de CPF
 * @returns {boolean} - true = válido / false = inválido
 */
function validarCPF(campo) {
    const cpfRaw = campo.value;

    // verifica o formato com máscara
    if (!cpfMaskRegex.test(cpfRaw)) {
        campo.style.border = '2px solid red';
        campo.setCustomValidity('Formato inválido. Use 999.999.999-99');
        return false;
    }

    const cpf = cpfRaw.replace(/\D/g, '');

    // remove CPFs com todos os dígitos iguais
    if (/^(\d)\1{10}$/.test(cpf)) {
        campo.style.border = '2px solid red';
        campo.setCustomValidity('CPF inválido (dígitos repetidos).');
        return false;
    }

    // calcular dígito verificador
    function calcularDigito(arr, pesoInicial) {
        let soma = 0;
        for (let i = 0; i < arr.length; i++) {
            soma += arr[i] * (pesoInicial - i);
        }
        const resto = soma % 11;
        return resto < 2 ? 0 : 11 - resto;
    }

    const nums = cpf.split('').map(n => parseInt(n, 10));
    const d1 = calcularDigito(nums.slice(0, 9), 10);
    const d2 = calcularDigito(nums.slice(0, 10), 11);

    if (d1 !== nums[9] || d2 !== nums[10]) {
        campo.style.border = '2px solid red'; // vermelho para inválido
        campo.setCustomValidity('CPF inválido.');
        return false;
    }

    // CPF válido
    campo.style.border = '1px solid green'; // verde válido
    campo.setCustomValidity('');
    return true;
}

document.addEventListener('DOMContentLoaded', function() {
    const campoCPF = document.getElementById('id_cpf');

    // máscara automática ao digitar
    campoCPF.addEventListener('input', function() {
        aplicarMascaraCPF(campoCPF);
    });

    // validação ao sair do campo
    campoCPF.addEventListener('blur', function() {
        validarCPF(campoCPF);
    });
});
