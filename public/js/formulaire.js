// fonction ChangeElement est utiliser pou creer de nouvelle option 
function ChangeElement(NewElement, type) {
    const OptionConteneur = document.createElement('div');
    OptionConteneur.classList.add('options-container');

    const btnAddOption = document.createElement('button');
    btnAddOption.textContent = 'Ajouter une option';
    
    btnAddOption.type = 'button';
    btnAddOption.classList.add('btn', 'btn-secondary', 'add-option', 'm-2');

    OptionConteneur.appendChild(btnAddOption);
    NewElement.appendChild(OptionConteneur); 

    let compte = 1;

    btnAddOption.addEventListener('click', function () {
        const OptionElemntInput = document.createElement('input');
        OptionElemntInput.type = 'text';
        OptionElemntInput.placeholder = 'Veuillez entrer option ' + `${compte}`;
        OptionElemntInput.classList.add('form-control', 'mb-2');
        
        OptionElemntInput.name = `formulaire[champs][${NewElement.dataset.index}][options][]`;

        OptionConteneur.appendChild(OptionElemntInput);
        compte++;
    });
}
// Fonction pour creer de la formulaire dynamique
document.addEventListener('DOMContentLoaded', function () {
    const addChampButton = document.getElementById('add-champ');
    const container = document.querySelector('[data-prototype]');
    const prototype = container.dataset.prototype;
    let index = container.children.length;

    addChampButton.addEventListener('click', function (e) {
        e.preventDefault();

        const newForm = prototype.replace(/__champs__/g, index);
        const NewElement = document.createElement('div');
        NewElement.classList.add('row', 'mb-3');
        NewElement.dataset.index = index;  

        const typeColumn = document.createElement('div');
        typeColumn.classList.add('col');
        typeColumn.innerHTML = newForm.match(/<select[^>]*>[\s\S]*?<\/select>/)[0];

        const nomColumn = document.createElement('div');
        nomColumn.classList.add('col');
        nomColumn.innerHTML = newForm.match(/<input[^>]*>/)[0];

        typeColumn.querySelector('select').addEventListener('change', function () {
            switch (this.value) {
                case 'radio':
                    ChangeElement(NewElement, 'radio');
                    break;
                case 'selectbox':
                    ChangeElement(NewElement, 'selectbox');
                    break;
                default:
                    break;
            }
        });
        NewElement.appendChild(typeColumn);
        NewElement.appendChild(nomColumn);
        container.appendChild(NewElement);
        index++;
    });
});
