import flask

app = flask.Blueprint("hello", __name__)

@app.route("/")
def hello():
        return flask.render_template("hello.html", message="hi there!")

@app.route("/<message>")
def themessage(message):
        return flask.render_template("hello.html", message=message)
