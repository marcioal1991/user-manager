FROM node:18-alpine

WORKDIR /srv/app
#
#RUN #rm -rf node_modules
#COPY ../../frontend-app/package.json /srv/app/package.json
#COPY ../../frontend-app/package-lock.json /srv/app/package-lock.json
RUN npm install react-scripts@latest
RUN npm install
EXPOSE 3000

ENTRYPOINT ["/usr/local/bin/npm"]

CMD ["start"]
