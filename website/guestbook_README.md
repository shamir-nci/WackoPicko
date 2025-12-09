Stored XSS - Vuln #4

Stored XSS occurs when user-generated content is saved to a database WITHOUT encoding, then displayed to other users WITHOUT encoding. Malicious JavaScript code injected by an attacker executes in the browsers of all users viewing the content.

// Vuln (Code & Fix)

Vuln Code:

<p class="comment"><?= $guest["comment"] ?></p> // Vuln Code

Fix:

<p class="comment"><?=h( $guest["comment"] )?></p>

// Justification:

The comment is retrieved from the database and displayed WITHOUT output encoding. By wrapping the comment output with the h() function (which applies htmlspecialchars()), we convert HTML special characters to text entities. This prevents JavaScript from executing and only displays the text to the user.