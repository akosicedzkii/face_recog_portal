FROM ubuntu:18.04

RUN apt-get update && \
        apt-get install -y software-properties-common vim 
RUN apt-get update -y

RUN apt-get install -y build-essential python3.6 python3.6-dev python3-pip python3.6-venv && \
        apt-get install -y git

# update pip
RUN python3.6 -m pip install pip --upgrade && \
        python3.6 -m pip install wheel

RUN apt-get install apache2 

VOLUME .

