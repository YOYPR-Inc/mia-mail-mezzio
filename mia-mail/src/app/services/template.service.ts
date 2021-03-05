import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { AuthenticationService, MiaAuthHttpService } from '@mobileia/authentication';
import MIATemplate from '../entities/template';

@Injectable({
  providedIn: 'root'
})
export class TemplateService extends MiaAuthHttpService {

  baseUrl = '';

  constructor(
    protected http: HttpClient,
    protected authService: AuthenticationService
  ) {
    super(http, authService);
  }

  fetchAllTemplates(): Promise<any> {
    return this.postAuthObjectPro(this.baseUrl + 'mia-mail-admin/list', { });
  }

  saveTemplate(template: MIATemplate): Promise<any> {
    return this.postAuthObjectPro(this.baseUrl + 'mia-mail-admin/save', template);
  }

  sendTest(templateId: number, email: string, subject: string, contentHtml: string, contentText: string): Promise<any> {
    return this.postAuthObjectPro(this.baseUrl + 'mia-mail-admin/send-preview', { id: templateId, email: email, subject: subject, content: contentHtml, content_text: contentText });
  }
}
