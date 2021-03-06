<h1>API DOCUMENTATION</h1>
<h2>AUTHORIZATION : BEARER TOKEN</h1>
<p>This API was built with PHP(LARAVEL FRAMEWORK) and authentaicated with JWT token</p>

<h2>SETUP</h2>
<ul>
    <li>Clone the repository</li>  
    <li>Run <code>composer install</code></li>
    <li>Run <code>php artisan key:generate</code></li>
    <li>Create a database name talentql_db</li>
    <li>Run <code>php artisan migrate</code></li> 
</ul>
<h2>ENDPOINTS</h2>
<span>Base URL: /api/v1</span>
<div>
    <h3>Register</h3>
    <ul>
        <li>URL: <span>/register</span></li>  
        <li>METHOD: POST</li>
        <li>BODY
            <ul>
                <li>username</li>
                <li>email</li>
                <li>password</li>
            </ul>
        </li>
        <li>Users: GUEST</li>
    </ul>
</div>
<div>
    <h3>Login</h3>
    <ul>
        <li>URL: <span>/login</span></li>  
        <li>METHOD: POST</li>
        <li>BODY
            <ul>
                <li>email</li>
                <li>password</li>
            </ul>
        </li>
        <li>Users: GUEST</li>
    </ul>
</div>
<div>
    <h3>Matrix</h3>
    <ul>
        <li>URL: <span>/login</span></li>  
        <li>METHOD: GET</li>
        <li>BODY
            <ul>
                <li>matrixA</li>
                <li>matrixB</li>
            </ul>
        </li>
        <li>Request sample
        <code>
            <pre>{
                "matrixA": {
                    "1" : ["a", "b", "c"],
                    "2" : ["c", "v", "2"],
                    "3" : ["g", "k", "j"]
                },
                "matrixB": {
                    "1" : ["a", "f", "h"],
                    "2" : ["c", "g", "j"],
                    "3": ["l", "o", "O"]
                }
            }</pre>
        </code>
        <li>
        <li>Response sample
        <code>
            <pre>{
                "result": {
                    "1": [
                        "aabccl",
                        "afbgco",
                        "ahbjcO"
                    ],
                    "2": [
                        "cavc2l",
                        "cfvg2o",
                        "chvj2O"
                    ],
                    "3": [
                        "gakcjl",
                        "gfkgjo",
                        "ghkjjO"
                    ]
                }
            }</pre>
        </code>
        </li>
        <div>
            <h5>The keys of the array specify the row and the value specify the value in the row column e.g { "1": ['a', 'b']} means row 1 have a in column 1 and b in column 2</h5>
            <h5><b>Always send keys as number starting from 1<b></h5>
        </div>
        <li>Users: AUTH</li>
    </ul>
</div>
<div>
    <h3>Logout</h3>
    <ul>
        <li>URL: <span>/logout</span></li>  
        <li>METHOD: POST</li>
        <li>Users: AUTH</li>
    </ul>
</div>
