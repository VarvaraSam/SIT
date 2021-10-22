

function OnClick()
{
    let textarea = document.querySelector('.msg-send');
    let text = textarea.value;
    if (textarea.value.length <= 0)
    {
        return;
    }
    textarea.value = '';
    AddMessage(text);
}

function AddMessage(text) {
    const chatBox = document.querySelector('.msg-box');
    const messege = document.querySelector('#msg-template').content.cloneNode(true);
    messege.querySelector('.msg-content').innerText = text;
    console.log(messege);
    chatBox.append(messege);
}
