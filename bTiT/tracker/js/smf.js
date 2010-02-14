function setOuterHTML(element, toValue)
{
if (typeof(element.outerHTML) != 'undefined')
element.outerHTML = toValue;
else
{
var range = document.createRange();
range.setStartBefore(element);
element.parentNode.replaceChild(range.createContextualFragment(toValue), element);
}
}

var allowed_attachments = 20 - 1;

function addAttachment(size)
{
setOuterHTML(document.getElementById("moreAttachments"), '<br /><input type="input" size="' +size + '" maxlength="200" name="attachment[]" /><span id="moreAttachments"></span>');
allowed_attachments = allowed_attachments - 1;
return true;
}