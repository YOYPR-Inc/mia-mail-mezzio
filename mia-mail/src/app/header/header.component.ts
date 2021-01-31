import { Component, EventEmitter, OnInit, Output } from '@angular/core';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {

  @Output() updateUrl = new EventEmitter<string>();

  baseUrl = 'https://agencycoda.com';

  constructor() { }

  ngOnInit(): void {
  }

  onChangeUrl() {
    this.updateUrl.emit(this.baseUrl);
  }
}
