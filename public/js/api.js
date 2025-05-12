const API = {
    base: "/api",

    async request(path, options = {}) {
        const token = localStorage.getItem("token");
        const headers = {
            "Content-Type": "application/json",
            ...(token && { Authorization: `Bearer ${token}` }),
        };

        const res = await fetch(`${this.base}${path}`, {
            ...options,
            headers,
        });

        const data = await res.json();
        if (!res.ok) throw data;
        return data;
    },

    register(body) {
        return this.request("/register", {
            method: "POST",
            body: JSON.stringify(body),
        });
    },

    login(body) {
        return this.request("/login", {
            method: "POST",
            body: JSON.stringify(body),
        });
    },

    me() {
        return this.request("/user/me");
    },

    logout() {
        return this.request("/logout", { method: "POST" });
    },

    getUsers() {
        return this.request("/users");
    },
};
