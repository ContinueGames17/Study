function login() {
    let email = document.getElementById("email").value;
    let senha = document.getElementById("senha").value;

    if (email === "aluno@email.com" && senha === "1234")
    {
        // Login do aluno.
        window.location.href = "usuario.html";
    }
    else if (email === "professor@email.com" && senha === "5678")
    {
        // Login do professor.
        window.location.href = "professor.html";
    }
    else
    {
        // Login incorreto.
        document.getElementById("mensagem").innerText = alert('E-mail ou senha incorretos!');
    }
}