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

  previewEmail = '';

  constructor(
    protected templateService: TemplateService,
    protected sanitizer: DomSanitizer
  ){

  }

  selectedTemplate(template: MIATemplate) {
    this.template = template;
    console.log(this.template);
  }

  sendTest() {
    this.templateService.sendTest(this.template!.id, this.previewEmail, this.template!.subject, this.processVarsInTemplate(this.template?.content!), this.template!.content_text).then(data => {
      alert('Send!!');
    });
  }

  addVar() {
    this.template?.vars.push({ id: '', title: '', caption: '', testing: '' });
  }

  deleteVar() {
    this.template?.vars.shift();
  }

  getSanitizierHtml() {
    return this.sanitizer.bypassSecurityTrustHtml(this.processVarsInTemplate(this.template?.content!));
  }

  processVarsInTemplate(content: string): string {
    let html = content;

    html = html.replace(/\<\?php echo/g, '{{');
    html = html.replace(/\?\>/g, '}}');

    if(this.template?.vars == undefined){
      return html;
    }

    for (const vari of this.template?.vars!) {
      html = html.replace(/{{'+vari.id+'}}/g, vari.testing); 
    }

    console.log(html);
    return html;
  }

  refreshTemplates(newUrl: string) {
    this.templateService.baseUrl = newUrl;
    this.templateSelector.refreshTemplates();
  }
}
