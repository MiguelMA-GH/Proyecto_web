function mostrarDiv()
{

    document.getElementById('imagen').style.display='block';

}

function ocultarDiv()
{

    document.getElementById('imagen').style.display='none';

}

function handleFiles(e)	{
    let ctx	=	document.getElementById('canvas').getContext('2d');
    let img	=	new	Image;
    img.src	=	URL.createObjectURL(e.target.files[0]);
    img.onload	=	function()	{
                    ctx.drawImage(img,	20,20);
    }
}


document.getElementById('imagen').style.display='none';