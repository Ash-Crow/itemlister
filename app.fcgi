#!/data/project/itemlister/venv/bin/python
from flup.server.fcgi import WSGIServer
from flask_appconfig import AppConfig
from flask import Flask, request
from flask_bootstrap import Bootstrap
from flask_nav import Nav

import time
import logging

from controllers import itemlister

# create Flask application
app = Flask(__name__)
AppConfig(app)
Bootstrap(app)
app.register_blueprint(itemlister.app)

# configure Flask logging
from logging import FileHandler
logger = FileHandler('error.log')
app.logger.setLevel(logging.DEBUG)
app.logger.addHandler(logger)

nav = Nav()
nav.init_app(app)

# log Flask events
app.logger.debug(u"Flask server started " + time.asctime())
@app.after_request
def write_access_log(response):
    app.logger.debug(u"%s %s -> %s" % (time.asctime(), request.path, response.status_code))
    return response

# start server
if __name__ == '__main__':
    WSGIServer(app).run()
