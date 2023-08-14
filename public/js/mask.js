const handlePhone = (event) => {
    let input = event.target
    input.value = phoneMask(input.value)
}

const phoneMask = (v) => {
    if (!v) return ""
    v = v.replace(/\D/g, '')
    v = v.replace(/(\d{2})(\d)/, "($1) $2")
    v = v.replace(/(\d)(\d{4})$/, "$1-$2")
    return v
}

