#!/data/project/itemlister/venv/bin/python
from flup.server.fcgi import WSGIServer
from flask import Flask, request
import time
import logging
from controllers import hello

# create Flask application
app = Flask(__name__)
app.register_blueprint(hello.app)

# configure Flask logging
from logging import FileHandler
logger = FileHandler('error.log')
app.logger.setLevel(logging.DEBUG)
app.logger.addHandler(logger)

# log Flask events
app.logger.debug(u"Flask server started " + time.asctime())
@app.after_request
def write_access_log(response):
    app.logger.debug(u"%s %s -> %s" % (time.asctime(), request.path, response.status_code))
    return response

# start server
if __name__ == '__main__':
    WSGIServer(app).run()
