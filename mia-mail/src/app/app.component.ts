import { Component, ViewChild } from '@angular/core';
import { DomSanitizer } from '@angular/platform-browser';
import MIATemplate from './entities/template';
import { TemplateService } from './services/template.service';
import { TemplateSelectorComponent } from './template-selector/template-selector.component';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  
  @ViewChild('templateSelector')
  templateSelector!: TemplateSelectorComponent;

  template: MIATemplate | undefined;
  typeShow = 0;

  constructor(
    protected templateService: TemplateService,
    protected sanitizer: DomSanitizer
  ){

  }

  selectedTemplate(template: MIATemplate) {
    this.template = template;
    console.log(this.template);
  }

  addVar() {
    this.template?.vars.push({ id: '', title: '', caption: '', testing: '' });
  }

  getSanitizierHtml() {
    return this.sanitizer.bypassSecurityTrustHtml(this.template?.content!);
  }

  refreshTemplates(newUrl: string) {
    this.templateService.baseUrl = newUrl;
    this.templateSelector.refreshTemplates();
  }
}
