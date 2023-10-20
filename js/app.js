function fechar()
{
    let elemento = document.getElementsByClassName('error')[0];
    elemento.classList.remove('error');
    elemento.classList.add('fechar');
}

import IMask from 'imask';

const tel = document.getElementsByName("caf")[0];
const maskOptions = {
    mask: '{73} (9)0000-0000'
};
const mask = IMask(tel, maskOptions);
console.log('a');