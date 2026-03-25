function textAnalyze()
{
    var text=document.getElementById("inputText").value;

    if(text.trim()==="")
    {
        alert("Please enter some text to analyze.");
        return false;
    }

    var wordCount=text.trim().split(/\s+/).length;
    var charCount=text.length;
    var reversedText=text.split(/\s+/).reverse().join(" ");

    document.getElementById("wordCount").innerText=wordCount;
    document.getElementById("charCount").innerText=charCount;
    document.getElementById("reverseSentence").innerText=reversedText;
}