function submitNumber() {
    let resultContainer = document.querySelector('#result')
    let form = document.querySelector('form')
    
    form.addEventListener('submit', function(event) {
        event.preventDefault()

        let formData = new FormData(form)

        let request = new XMLHttpRequest()
        request.open("POST", "./processor.php", true)
        request.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let result = this.responseText
                resultContainer.innerHTML = result
            }
        }

        request.send(formData)
    })

}

submitNumber()