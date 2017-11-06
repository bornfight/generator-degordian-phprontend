'use strict';
const Generator = require('yeoman-generator');
const chalk = require('chalk');
const yosay = require('yosay');
const path = require('path');
const mkdirp = require('mkdirp');

const isFeatureSelected = (featureList, feature) => {
  return featureList.indexOf(feature) !== -1;
};

const featuresConfig = {};
const jsPlugins = [
  {
    name: 'jQuery',
    value: 'jquery',
    checked: true
  },
  {
    name: 'TweenMax',
    value: 'tweenmax'
  },
  {
    name: 'svgxuse - icomoon',
    value: 'svgxuse'
  },
  {
    name: 'ScrollMagic',
    value: 'scrollmagic'
  },
  {
    name: 'Slick slider',
    value: 'slick_slider'
  },
  {
    name: 'is.js',
    value: 'is_js'
  }
];

const cssPlugins = [
  {
    name: 'normalize.css',
    value: 'normalize_css',
    checked: true
  },
  {
    name: 'Susy',
    value: 'susy'
  }
];

module.exports = class extends Generator {
  prompting() {
    // Have Yeoman greet the user.
    this.log(yosay(
      'Welcome to the ace ' + chalk.red('Degordian phprontend') + ' generator!'
    ));
    this.log(`Please enter the project's name. Supplying the name of the current folder will scaffold the application ${chalk.red('in the current folder')}.
Supplying a new name will create the folder for you.`);
    // Prompting the user
    const prompts = [{
      type: 'input',
      name: 'name',
      message: 'What is the name of the project?',
      validate: input => {
        return input.length > 0 ? true : 'Project name contains no characters.';
      }
    },
    {
      type: 'list',
      name: 'projectType',
      message: 'Is this project Yii or Wordpress based?',
      choices: [{
        name: 'Yii',
        value: 'yii'
      },
      {
        name: 'Wordpress',
        value: 'wp'
      }]
    },
    {
      type: 'checkbox',
      name: 'jsPlugins',
      message: 'What JavaScript plugins do you need?',
      choices: jsPlugins
    }, {
      type: 'checkbox',
      name: 'cssPlugins',
      message: 'What CSS plugins do you need?',
      choices: cssPlugins
    }];

    return this.prompt(prompts).then(props => {
      // To access props later use this.props.someAnswer;
      this.props = props;
    });
  }

  setPlugins() {
    const selectedJsPlugins = this.props.jsPlugins;
    const selectedCssPlugins = this.props.cssPlugins;

    jsPlugins.forEach(plugin => {
      featuresConfig[plugin.value] = isFeatureSelected(selectedJsPlugins, plugin.value);
    });

    cssPlugins.forEach(plugin => {
      featuresConfig[plugin.value] = isFeatureSelected(selectedCssPlugins, plugin.value);
    });

    featuresConfig.name = this.props.name;
    featuresConfig.projectType = this.props.projectType;
  }

  createFolderIfDoesNotExist() {
    if (path.basename(this.destinationPath()) !== this.props.name) {
      this.log(`Creating a folder named ${this.props.name}`);
      mkdirp(this.props.name);
      this.destinationRoot(this.destinationPath(this.props.name));
    }
  }

  writing() {
    this.fs.copyTpl(
      this.templatePath(`slice/${this.props.projectType}`),
      this.destinationPath('slice'),
      featuresConfig
    );

    this.fs.copyTpl(
      this.templatePath('common/**'),
      this.destinationRoot(),
      Object.assign({
        globOptions: {
          dot: true
        }
      }, featuresConfig)
    );

    this.fs.copy(
      this.templatePath('dotfiles/**'),
      this.destinationRoot(),
      {
        globOptions: {
          dot: true
        }
      }
    );

    this.fs.copyTpl(
      this.templatePath('static/**'),
      this.destinationPath('static'),
      Object.assign({
        globOptions: {
          dot: true
        }
      }, featuresConfig)
    );
  }

  createDirectories() {
    mkdirp.sync(path.join(this.destinationPath(), 'static/dist'));
    mkdirp.sync(path.join(this.destinationPath(), 'static/fonts'));
    mkdirp.sync(path.join(this.destinationPath(), 'static/images'));

    mkdirp.sync(path.join(this.destinationPath(), 'static/scss/base'));
    mkdirp.sync(path.join(this.destinationPath(), 'static/scss/components'));
    mkdirp.sync(path.join(this.destinationPath(), 'static/scss/plugins'));
    mkdirp.sync(path.join(this.destinationPath(), 'static/scss/pages'));
    mkdirp.sync(path.join(this.destinationPath(), 'static/scss/helpers/functions'));
    mkdirp.sync(path.join(this.destinationPath(), 'static/scss/helpers/mixins'));
    mkdirp.sync(path.join(this.destinationPath(), 'static/scss/helpers/plugins'));

    mkdirp.sync(path.join(this.destinationPath(), 'static/js/vendor'));
  }

  install() {
    this.installDependencies({
      npm: true,
      bower: false
    });
  }
};
