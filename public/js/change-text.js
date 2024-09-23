// Changer le texte chaque 2 seconde
const fullTexts = [
    
    "Vous pouvez créer <span class='change-color'>votre propre formulaire</span>",
    "Vous pouvez consulter <span class='change-color'>votre formulaire</span>",
    "Personnalisez <span class='change-color'>votre formulaire ici</span>",
    "Simple, rapide <span class='change-color'>et efficace</span>"
];

let index = 0;

function changeFullText() {
    const textElement = document.getElementById("dynamic-text");
    
    textElement.innerHTML = fullTexts[index];
    
    index = (index + 1) % fullTexts.length; 
}

setInterval(changeFullText, 2000); 