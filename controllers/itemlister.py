import flask

app = flask.Blueprint("itemlister", __name__)

@app.route("/")
def homepage():
        return flask.render_template("itemlister.html", message="hi there!")

@app.route("/<wiki>/<title>")
def list_items(wiki, title):
		message = "You requested the links for page {} on {}.".format(title, wiki)
        return flask.render_template("itemlister.html", message=message)
