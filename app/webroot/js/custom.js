function resizeIframe(newHeight)
{
    alert(newHeight);
    document.getElementById('resultIframe').style.height = parseInt(newHeight,10) + 10 + 'px';
}