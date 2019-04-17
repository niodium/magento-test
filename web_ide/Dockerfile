FROM debian:stretch-slim



RUN apt-get update -y && \
    apt-get install -y git curl wget build-essential checkinstall libreadline-gplv2-dev \
                       libncursesw5-dev libssl-dev libsqlite3-dev tk-dev libgdbm-dev libc6-dev \
                       libbz2-dev g++ locales apache2-utils libxml2-dev sshfs supervisor && \
    rm -rf /var/lib/apt/lists/* && \
    sed -i 's/^\(\[supervisord\]\)$/\1\nnodaemon=true/' /etc/supervisor/supervisord.conf

RUN update-rc.d supervisor defaults

RUN echo 'en_US.UTF-8 UTF-8'>/etc/locale.gen && locale-gen

RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -

RUN wget https://www.python.org/ftp/python/2.7.16/Python-2.7.16.tgz && \
    tar -xvf Python-2.7.16.tgz

RUN cd Python-2.7.16 && \
    ./configure && \
    make 

RUN apt-get update -y && \
    apt-get install -y nodejs

RUN git clone https://github.com/c9/core.git cloud9 
    
RUN cloud9/scripts/install-sdk.sh

RUN sed -i -e 's_127.0.0.1_0.0.0.0_g' /cloud9/configs/standalone.js 

ADD conf/cloud9.conf /etc/supervisor/conf.d/

RUN mkdir /workspace
VOLUME /workspace


RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

EXPOSE 80
EXPOSE 3000

CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]