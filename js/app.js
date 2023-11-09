function fechar()
{
    let elemento = document.getElementsByClassName('overlap')[0];
    elemento.classList.remove('overlap');
    elemento.classList.add('fechar');
}