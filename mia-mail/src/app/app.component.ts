import { Component, ViewChild } from '@angular/core';
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

  constructor(
    protected templateService: TemplateService
  ){

  }

  refreshTemplates(newUrl: string) {
    this.templateService.baseUrl = newUrl;
    this.templateSelector.refreshTemplates();
  }
}
