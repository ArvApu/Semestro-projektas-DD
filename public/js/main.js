const renginiai = document.getElementsByClassName('container');

const xd = document.getElementsByClassName("istrinti");

alert(2);

if (renginiai)
{
    renginiai.addEventListener('click', e => {
        if(e.target.className === "istrinti") 
        {

            alert(3);
        }
    });
}