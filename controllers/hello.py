import flask
from flask_bootstrap import Bootstrap

app = flask.Blueprint("hello", __name__)
Bootstrap(app)

@app.route("/")
def hello():
        return flask.render_template("hello.html", message="hi there!")

@app.route("/<message>")
def hello():
        return flask.render_template("hello.html", message=message)
