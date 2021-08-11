import { useState } from "react";
import { useHistory } from "react-router-dom";

const Login = () => {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [error, setError] = useState("");

    let history = useHistory();

    async function login() {
        const res = await fetch(`http://localhost:80/api/auth/login`, {
            method: "POST",
            body: JSON.stringify({
                email: email,
                password: password,
            }),
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });

        if (res.status !== 200) {
            setError("Wrong credentials");
        }

        const json = await res.json();
        localStorage.setItem("token", json.token);
        history.push("/");
    }

    return (
        <div>
            <form
                onSubmit={(e) => {
                    e.preventDefault();
                    login();
                }}
            >
                <span style={{ color: "red" }}>{error}</span>
                <br />
                <label htmlFor="email">
                    Email
                    <input
                        id="email"
                        onChange={(e) => setEmail(e.target.value)}
                        value={email}
                        placeholder="Email"
                    />
                </label>
                <br />
                <label htmlFor="password">
                    Password
                    <input
                        id="password"
                        onChange={(e) => setPassword(e.target.value)}
                        value={password}
                        placeholder="Password"
                        type="password"
                    />
                </label>
                <br />
                <button>Login</button>
            </form>
        </div>
    );
};

export default Login;
