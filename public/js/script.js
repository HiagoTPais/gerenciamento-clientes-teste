const newPhone = (event) => {
    event.preventDefault()

    var listRoute = document.getElementById('list-phone')

    const id = randonString(6)

    const fields = `
        <div class="d-flex m-1" id="phone-`+ id + `">
            <input type="text" name="phone[]" maxlength="15" onkeyup="handlePhone(event)" class="input-resp w-50">
            <button class="btn btn-danger" onclick="remove('phone-`+ id + `', event)">-</button>
        </div>
    `

    listRoute.innerHTML += fields
}

const remove = (id, event) => {
    event.preventDefault()
    document.getElementById(id).remove()
}

const randonString = (length) => {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    let counter = 0;

    while (counter < length) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
        counter += 1;
    }

    return result;
}