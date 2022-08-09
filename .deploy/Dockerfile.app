ARG BASE_IMAGE

FROM $BASE_IMAGE AS app

COPY .deploy/bash/app.sh app.sh
RUN chmod +x app.sh

EXPOSE 9000