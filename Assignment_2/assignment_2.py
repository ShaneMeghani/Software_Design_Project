from flask import Flask, redirect, url_for, render_template, request, session

app = Flask(__name__)
app.secret_key = "fasiu12098a"

@app.route("/", methods=["POST", "GET"])
@app.route("/login", methods=["POST", "GET"])
def login():
    error = None
    if request.method == "POST":
        if request.form["user_name"] == "testuser@mail.com" and request.form["password"] == "testuser":
            user = request.form["user_name"]
            return redirect(url_for("user", usr=user))
        else:
            error = "Invalid Credentials"
    return render_template("login.html", error=error)

@app.route('/register')
def register():
    return render_template('newaccount.html')

@app.route('/profile')
def profile():
    return render_template('profile.html')

@app.route('/fuel')
def fuel():
    return render_template('fuel.html')

@app.route('/history')
def history():
    return render_template('history.html')

@app.route('/logout')
def logout():
    return render_template('login.html')


@app.route("/<usr>", methods=["GET", "POST"])
def user(usr):
    if request.method == "POST":
        usr = "null"
    if usr == "testuser@mail.com":
        return render_template("mainpage.html")

if __name__ == "__main__":
    app.run(debug=True, port=5001)
